<?php
class Session
{
    private array $messages;

    public function __construct()
    {
        session_start();
        $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public function logout()
    {
        session_destroy();
    }

    public function getUser(): ?User
    {
        return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
    }

    public function getUserSerialized(): ?String
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public function setUser(User $user)
    {
        $_SESSION['user'] = serialize($user);
    }

    public function addMessage(string $type, string $text)
    {
        $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages()
    {
        unset($_SESSION['messages']);
        return $this->messages;
    }

    // Maybe add this fields and others like permissions

    public function setId(int $id)
    {
        $_SESSION['id'] = $id;
    }

    public function setName(string $name)
    {
        $_SESSION['name'] = $name;
    }

    public function getId(): ?int
    {
        $user = unserialize($_SESSION['user']);
        return $user->permissions[0]->id;
    }

    public function getName(): ?string
    {
        return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }
}
