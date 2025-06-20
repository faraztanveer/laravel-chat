# 💬 Laravel Chat

<div align="center">

[![Latest Version](https://img.shields.io/packagist/v/faraztanveer/laravel-chat?style=for-the-badge&logo=packagist&logoColor=white)](https://packagist.org/packages/faraztanveer/laravel-chat)
[![Downloads](https://img.shields.io/packagist/dt/faraztanveer/laravel-chat?style=for-the-badge&logo=packagist&logoColor=white)](https://packagist.org/packages/faraztanveer/laravel-chat)
[![Monthly Downloads](https://img.shields.io/packagist/dm/faraztanveer/laravel-chat?style=for-the-badge&logo=packagist&logoColor=white)](https://packagist.org/packages/faraztanveer/laravel-chat)
[![GitHub Stars](https://img.shields.io/github/stars/faraztanveer/laravel-chat?style=for-the-badge&logo=github&logoColor=white)](https://github.com/faraztanveer/laravel-chat)
[![GitHub Forks](https://img.shields.io/github/forks/faraztanveer/laravel-chat?style=for-the-badge&logo=github&logoColor=white)](https://github.com/faraztanveer/laravel-chat)
[![Code Style](https://img.shields.io/github/actions/workflow/status/faraztanveer/laravel-chat/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge&logo=php)](https://github.com/faraztanveer/laravel-chat/actions)
[![PHP Version](https://img.shields.io/packagist/php-v/faraztanveer/laravel-chat?style=for-the-badge&logo=php&logoColor=white)](https://packagist.org/packages/faraztanveer/laravel-chat)
[![Laravel Version](https://img.shields.io/badge/laravel-12+-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![License](https://img.shields.io/github/license/faraztanveer/laravel-chat?style=for-the-badge&logo=github&logoColor=white)](https://github.com/faraztanveer/laravel-chat/blob/main/LICENSE)
[![Last Commit](https://img.shields.io/github/last-commit/faraztanveer/laravel-chat?style=for-the-badge&logo=github&logoColor=white)](https://github.com/faraztanveer/laravel-chat/commits)
[![Made with Love](https://img.shields.io/badge/made%20with-❤️-red?style=for-the-badge)](https://github.com/faraztanveer/laravel-chat)

**🚀 A blazingly fast, modern chat system for Laravel 12+**

*Built for real-time applications, infinite customization, and developer happiness*

[📦 Installation](#-installation) • [✨ Features](#-features) • [⚙️ Quick Start](#%EF%B8%8F-quick-start) • [📡 API Reference](#-api-reference) • [🤝 Contributing](#-contributing)

</div>

---

---

## ✨ Features

<table>
<tr>
<td width="50%">

### 🎯 **Zero Configuration**
- Works out of the box with sensible defaults
- Auto-discovered database migrations
- No complex setup required

</td>
<td width="50%">

### ⚡ **Lightning Fast**
- Optimized database queries
- Minimal performance overhead
- Ready for real-time implementations

</td>
</tr>
<tr>
<td>

### 🔧 **Fully Customizable**
- Use your existing models and rules
- Extend functionality as needed
- Clean, simple architecture

</td>
<td>

### 🛡️ **Enterprise Ready**
- Middleware-friendly design
- Configurable API routes
- Production-tested and reliable

</td>
</tr>
</table>

> 💡 **Perfect for**: Chat applications, messaging systems, customer support platforms, team collaboration tools, and any real-time communication needs.

---

## 🚀 Installation

```bash
# Install the package
composer require faraztanveer/laravel-chat

# Run migrations
php artisan migrate
```

<details>
<summary>📦 <strong>Optional: Publish configuration file</strong></summary>

```bash
php artisan vendor:publish --provider="Faraztanveer\LaravelChat\LaravelChatServiceProvider" --tag=config
```

</details>

---

## ⚙️ Quick Start

### 1️⃣ Setup Your User Model

Add the `HasChatChannels` trait to your user model:

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Faraztanveer\LaravelChat\Traits\HasChatChannels;

class User extends Authenticatable
{
    use HasChatChannels;
    
    // Your existing code...
}
```

### 2️⃣ Start Chatting!

That's it! Your application now has a fully functional chat system. The package provides RESTful API endpoints for all chat operations.

---

## 🎛️ Configuration

The package works seamlessly out of the box, but you can customize it to fit your needs.

**Configuration file (`config/laravel-chat.php`):**

```php
<?php

return [
    // Your participant model (usually User model)
    'participant_model' => App\Models\User::class,
    
    // API route customization
    'route_prefix' => 'chat',                    // Routes: /api/chat/*
    'route_middleware' => ['auth:sanctum'],      // Authentication middleware
];
```

---

## 📡 API Reference

All endpoints are available under `/api/{route_prefix}` (default: `/api/chat`).

| Method | Endpoint | Description | Request Body/Parameters |
|--------|----------|-------------|------------------------|
| `POST` | `/channel` | Create or retrieve a chat channel | `{"participant_id": 2}` |
| `GET` | `/channels` | List user's chat channels | – |
| `GET` | `/channel` | Get specific channel details | `?channel_id=1` |
| `POST` | `/message` | Send a message to channel | `{"channel_id": 1, "body": "Hello!"}` |
| `GET` | `/messages` | Retrieve channel messages | `?channel_id=1` |

### Example Usage

```javascript
// Create or get a chat channel
const response = await fetch('/api/chat/channel', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer your-token'
    },
    body: JSON.stringify({
        participant_id: 2
    })
});

// Send a message
await fetch('/api/chat/message', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer your-token'
    },
    body: JSON.stringify({
        channel_id: 1,
        body: "Hello there!"
    })
});
```

---

## 🎨 Customization

### Custom Display Names

Override the display name for chat participants:

```php
class User extends Authenticatable
{
    use HasChatChannels;
    
    public function getChatDisplayName(): string
    {
        return $this->full_name ?? $this->name;
    }
}
```

### Custom Participant Columns

Specify which columns to include in API responses:

```php
class User extends Authenticatable
{
    use HasChatChannels;
    
    public function chatParticipantColumns(): array
    {
        return ['id', 'name', 'email', 'avatar_url'];
    }
}
```

### Middleware Customization

You can customize authentication and authorization middleware in the configuration file:

```php
// config/laravel-chat.php
return [
    'route_middleware' => ['auth:sanctum', 'verified', 'custom-middleware'],
];
```

---

## 🪝 Event Listeners & Extending Chat Actions

This package dispatches events when key chat actions occur, allowing you to react (broadcast, notify, etc) in your own app—**without modifying package code**.

### Listening for Chat Events

You may listen for chat events by creating listeners with Artisan:

```bash
php artisan make:listener OnChatChannelCreated --event="\Faraztanveer\LaravelChat\Events\ChatChannelCreated"
php artisan make:listener OnChatMessageStored --event="\Faraztanveer\LaravelChat\Events\MessageStored"
```

When a chat channel is created or a message is stored, your listener's `handle` method will be called automatically with the **corresponding Eloquent model**.

### Example: Message Stored Listener

```php
<?php

namespace App\Listeners;

use Faraztanveer\LaravelChat\Events\MessageStored;
use Faraztanveer\LaravelChat\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Log;

class OnChatMessageStored
{
    public function handle(MessageStored $event): void
    {
        // $event->message is the Message model instance
        // Log with a resource for consistent structure as used in API responses
        Log::debug('Chat message stored', [
            'event' => new MessageResource($event->message),
        ]);
        
        // Add any custom logic here (broadcast, notifications, etc)
    }
}
```

### Example: Channel Created Listener

```php
<?php

namespace App\Listeners;

use Faraztanveer\LaravelChat\Events\ChatChannelCreated;
use Faraztanveer\LaravelChat\Http\Resources\ChatChannelResource;
use Illuminate\Support\Facades\Log;

class OnChatChannelCreated
{
    public function handle(ChatChannelCreated $event): void
    {
        // $event->channel is the ChatChannel model instance
        Log::debug('Chat channel created', [
            'event' => new ChatChannelResource($event->channel),
        ]);
        
        // Custom logic here (notify users, update UI, etc)
    }
}
```

### Resource Classes

The package provides resource classes (e.g. `MessageResource`, `ChatChannelResource`) which convert your models into the **same format as your API responses**.

You can use these in your listeners for logging, broadcasting, or passing structured data to your frontend—ensuring consistency between your API and event-driven features.

### What You Get in Your Listener

- **For message events:** `$event->message` is a full `Message` Eloquent model.
- **For channel events:** `$event->channel` is a full `ChatChannel` Eloquent model.
- Use the provided resources for serialization if needed.

**That's it!** Your app can now respond to every chat action, with models and resources consistent with your APIs. For advanced event usage, see the Laravel Events documentation.

---

## 🤝 Contributing

We welcome contributions! Here's how you can help make Laravel Chat even better:

- 🐛 **Found a bug?** [Open an issue](https://github.com/faraztanveer/laravel-chat/issues)
- 💡 **Have an idea?** [Start a discussion](https://github.com/faraztanveer/laravel-chat/discussions)
- 🔧 **Want to contribute code?** Check our [contributing guide](CONTRIBUTING.md)
- 📖 **Improve documentation?** Documentation PRs are always welcome!



---

## 🛡️ Security

Security is a top priority. If you discover any security-related issues, please email **faraz.io@outlook.com** instead of using the issue tracker.

See [SECURITY.md](SECURITY.md) for our security policy and vulnerability reporting process.

---

## 📋 Requirements

- PHP 8.2+
- Laravel 12.0+
- Database (MySQL, PostgreSQL, SQLite, SQL Server)

---

## 🗺️ Roadmap

- [ ] File attachment support
- [ ] Message reactions and emojis
- [ ] Message threading
- [ ] Advanced search functionality
- [ ] Message encryption
- [ ] Group chat management
- [ ] Message status indicators (sent, delivered, read)

---

## 📜 License

This package is open-sourced software licensed under the [MIT License](LICENSE.md).

---

## 👨‍💻 Credits

- **[Faraz Tanveer](https://github.com/faraztanveer)** - Creator & Maintainer
- **[All Contributors](https://github.com/faraztanveer/laravel-chat/contributors)** - Thank you! 🙏

---

<div align="center">

**Built with ❤️ for the Laravel community**

⭐ **Star this repository if it helped you!**

[🐛 Report Bug](https://github.com/faraztanveer/laravel-chat/issues) • [💡 Request Feature](https://github.com/faraztanveer/laravel-chat/issues) • [🐦 X](https://X.com/faraz_dev)


</div>
