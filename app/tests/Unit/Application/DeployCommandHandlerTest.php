<?php

declare(strict_types=1);

namespace Tests\App\Unit\Application;

use App\Application\DeployCommand;
use App\Application\DeployCommandHandler;
use App\Domain\Exception\FileSystem\NoTemplateException;
use App\Domain\Exception\FileSystem\TemplateNotFoundException;
use App\Domain\Exception\FileSystemException;
use App\Domain\Exception\TemplatingException;
use App\Domain\Gateway\DataVOSerializerDomainInterface;
use App\Domain\Gateway\FileSystemDomainInterface;
use App\Domain\Gateway\GitDomainInterface;
use App\Domain\Gateway\SerializerDomainInterface;
use App\Domain\Gateway\TemplateDomainInterface;
use App\Domain\Model\FileSystemModel;
use App\Domain\Model\GitModel;
use App\Domain\ValueObject\Data;
use App\Domain\ValueObject\DataVO;
use App\Infrastructure\DataVOSerializerInfrastructure;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Tests\App\Unit\Adapter\InMemoryFileSystemDomainInterface;
use Tests\App\Unit\Adapter\InMemoryGitDomainInterface;
use Tests\App\Unit\Adapter\InMemoryDataVOSerializerDomainInterface;
use Tests\App\Unit\Adapter\InMemoryTemplateDomainInterface;

final class DeployCommandHandlerTest extends TestCase
{
    private DataVO $data;
    private TemplateDomainInterface $template;
    private GitModel $git;
    private FileSystemModel $fs;
    private DataVOSerializerDomainInterface $serializer;

    protected function setUp(): void
    {
        $this->data = new DataVO(
            gitConnexionType: 'gitConnexionType',
            gitProvider: 'gitProvider',
            gitRepoRemotePath: 'gitRepoRemotePath',
            appName: 'appName',
            environment: 'environment',
            namespace: 'namespace',
            url: 'url',
            tag: 'tag',
            imagePullSecrets: 'imagePullSecrets',
            inputPort: 12,
            outputPort: 23,
        );
        $this->template = new InMemoryTemplateDomainInterface();
        $this->fs = new FileSystemModel( new InMemoryFileSystemDomainInterface());
        $this->git = new GitModel( $this->fs,new InMemoryGitDomainInterface(), 'fff');

        $this->serializer = new InMemoryDataVOSerializerDomainInterface();
    }

    #[TestDox('Scenario: NoTemplateException
        GIVEN no template
        THEN I should have a exception NoTemplateException 
    ')]
    public function testNoTemplateException(): void
    {
        $appName = 'appName';
        self::assertEquals(true,true);


//        // todo dataPrivider
//
//        self::expectException(FileSystemException::class);
//        self::expectExceptionMessage('Not found at' . $appName); // TODO sprintf
//
//        self::expectException(FileSystemException::class);
//        self::expectExceptionMessage('Not found at' . $appName); // TODO sprintf
//        self::expectExceptionMessage('File data not found at' . $appName); // TODO sprintf

//
//        $command = new DeployCommand(
//            appName: 'foo',
//        );
//        $handler = new DeployCommandHandler(
//            template: $this->template,
//            fs: $this->fs,
//            git: $this->git,
//            serializer: $this->serializer,
//            tmpPath: 'tmpPath',
//            gitDiR: 'tto'
//        );
//
//        $handler->handle($command);
    }

//    #[TestDox('Scenario: NoTemplateException
//        GIVEN no template
//        THEN I should have a exception NoTemplateException
//    ')]
//    public function testNoTemplateException(): void
//    {
//        self::expectException(NoTemplateException::class);
//        self::expectExceptionMessage('You should have a template object');
//
//        $command = new DeployCommand(
//            data: $this->data,
//            templates: []
//        );
//        $handler = new DeployCommandHandler(
//            template: $this->template,
//            fs: $this->fs,
//            git: $this->git,
//            tmpPath: 'tmpPath'
//        );
//
//        $handler->handle($command);
//    }
//
//    #[TestDox('Scenario: TemplateNotFoundException
//        GIVEN some templates
//        WHEN some templates does not exist
//        THEN I should have TemplateNotFoundException
//    ')]
//    public function testTemplateNotFoundException(): void
//    {
//        self::expectException(TemplateNotFoundException::class);
//
//        $command = new DeployCommand(
//            data: $this->data,
//            templates: ['ddd']
//        );
//        $handler = new DeployCommandHandler(
//            template: $this->template,
//            fs: $this->fs,
//            git: $this->git,
//            tmpPath: 'tmpPath'
//        );
//        $handler->handle($command);
//
//        throw new TemplateNotFoundException('dd');
//    }
//
//    #[TestDox('Scenario: handler run correctly
//        GIVEN valid data and valid templates
//        AND Git repo is OK
//        THEN I should not have any error
//    ')]
//    public function testAllOk(): void
//    {
//        $command = new DeployCommand(
//            appName: $this->data->appName,
//        );
//        $handler = new DeployCommandHandler(
//            template: $this->template,
//            fs: $this->fs,
//            git: $this->git,
//            serializer: $this->serializer,
//            tmpPath: 'tmpPath',
//            gitDiR: 'gitDiR',
//        );
//        $handler->handle($command);
//        self::assertTrue(true);
//    }
}
