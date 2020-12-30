<?php

namespace PCN;

class Notification
{
    private string $title;
    private string $message;
    private string $icon;
    private string $sound;

    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            if (in_array($key, ['title', 'message', 'icon', 'sound'])) {
                $setter = 'set' . ucwords($key);
                $this->$setter($value);
            }
        }
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setIcon(string $icon): void
    {
        if (in_array($icon, ['info', 'warning', 'error', 'success'])) {
            $this->icon = realpath(dirname(__FILE__) . '/assets/icons/' . $icon . '.png');
        } else {
            $this->icon = $icon;
        }
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setSound(string $sound): void
    {
        if (in_array($sound, ['beep', 'error'])) {
            $this->sound = realpath(dirname(__FILE__) . '/assets/sounds/' . $sound . '.wav');
        } else {
            $this->sound = $sound;
        }
    }

    public function getSound(): string
    {
        return $this->sound;
    }

    public function toArray(): array
    {
        return [
            'title'   => $this->title ?? '',
            'message' => $this->message ?? '',
            'icon'    => $this->icon ?? '',
            'sound'   => $this->sound ?? '',
        ];
    }

    public function isValid(): bool
    {
        return !empty($this->title);
    }
}
