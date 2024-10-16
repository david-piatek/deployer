<?php

declare(strict_types=1);

namespace Tests\App\Unit\Application;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Domain\Exception\FileSystem\NoTemplateException;
use App\Domain\Exception\FileSystem\TemplateNotFoundException;
use App\Domain\Gateway\FileSystem;
use App\Domain\Gateway\Git;
use App\Domain\Gateway\Template;
use App\Domain\ValueObject\Data;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Tests\App\Unit\Adapter\InMemoryFileSystem;
use Tests\App\Unit\Adapter\InMemoryGit;
use Tests\App\Unit\Adapter\InMemoryTemplate;

final class DeployCommandHandlerTest extends TestCase
{
    private Data $data;
    private Template $template;
    private Git $git;
    private FileSystem $fs;

    protected function setUp(): void
    {
        $this->data = new Data(
            appName: 'appName',
            environment: 'environment',
            namespace: 'namespace',
            url: 'url',
            tag: 'tag',
            imagePullSecrets: 'imagePullSecrets',
            inputPort: 12,
            outputPort: 23,
        );
        $this->template = new InMemoryTemplate();
        $this->git = new InMemoryGit();
        $this->fs = new InMemoryFileSystem();
    }

    #[TestDox('Scenario: handler run correctly
        GIVEN valid data and valid templates
        AND Git repo is OK
        THEN I should not have any error
    ')]
    public function testAllOk(): void
    {
        $command = new DeployCommand(
            data: $this->data,
            templates: ['']
        );
        $handler = new DeployCommandHandler(
            template: $this->template,
            fs: $this->fs,
            git: $this->git,
            tmpPath: 'tmpPath'
        );
        $handler->handle($command);
        self::assertTrue(true);
    }

    #[TestDox('Scenario: NoTemplateException
        GIVEN no template
        THEN I should have a exception NoTemplateException 
    ')]
    public function testNoTemplateException(): void
    {
        self::expectException(NoTemplateException::class);
        self::expectExceptionMessage('You should have a template object');

        $command = new DeployCommand(
            data: $this->data,
            templates: []
        );
        $handler = new DeployCommandHandler(
            template: $this->template,
            fs: $this->fs,
            git: $this->git,
            tmpPath: 'tmpPath'
        );

        $handler->handle($command);
    }

    #[TestDox('Scenario: TemplateNotFoundException
        GIVEN some templates
        WHEN some templates does not exist 
        THEN I should have TemplateNotFoundException 
    ')]
    public function testTemplateNotFoundException(): void
    {
        self::expectException(TemplateNotFoundException::class);

        $command = new DeployCommand(
            data: $this->data,
            templates: ['ddd']
        );
        $handler = new DeployCommandHandler(
            template: $this->template,
            fs: $this->fs,
            git: $this->git,
            tmpPath: 'tmpPath'
        );
        $handler->handle($command);

        throw new TemplateNotFoundException('dd');
    }
}
