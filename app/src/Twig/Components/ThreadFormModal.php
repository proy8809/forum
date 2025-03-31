<?php

namespace App\Twig\Components;

use App\Entity\Thread;
use App\Repository\ThreadRepository;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\Component\Validator\Constraints as Assert;

#[AsLiveComponent]
final class ThreadFormModal
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;

    #[LiveProp]
    public string $actionName = "New";

    #[LiveProp(writable: true)]
    public bool $isShown = false;

    #[LiveProp(writable: ["title", "content"])]
    #[Assert\Valid]
    public ?Thread $thread = null;

    public function __construct(
        private readonly ThreadRepository $threadRepository,
    ) {
    }

    public function mount()
    {
        $this->thread = new Thread();
    }

    #[LiveListener("modalShown")]
    public function showModal(#[LiveArg("thread")] ?int $threadId = null): void
    {
        $this->thread = new Thread();

        if (isset($threadId)) {
            $this->thread = $this->threadRepository->find($threadId);
        }

        $this->actionName = isset($this->thread) ? "Edit" : "New";

        $this->isShown = true;
    }

    #[LiveAction]
    public function hideModal(): void {
        $this->isShown = false;
    }

    #[LiveAction]
    public function saveThread(#[CurrentUser] $userEntity): void
    {
        $this->validate();

        if (!$this->thread->getId()) {
            $this->thread->setCreatedAt(new \DateTimeImmutable());
            $this->thread->setUser($userEntity);
        }

        $this->thread->setUpdatedAt(new \DateTimeImmutable());
        $this->threadRepository->persist($this->thread);

        $this->isShown = false;
    }
}
