# 💬 Laravel Chat

<div align="center">

[![Latest Version](https://img.shields.io/packagist/v/faraztanveer/laravel-chat?style=for-the-badge&logo=packagist&logoColor=white)](https://packagist.org/packages/faraztanveer/laravel-chat)
[![Code Style](https://img.shields.io/github/actions/workflow/status/faraztanveer/laravel-chat/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge&logo=php)](https://github.com/faraztanveer/laravel-chat/actions)
[![Downloads](https://img.shields.io/packagist/dt/faraztanveer/laravel-chat?style=for-the-badge&logo=packagist&logoColor=white)](https://packagist.org/packages/faraztanveer/laravel-chat)

**🚀 A blazingly fast, modern chat system for Laravel 12+**

*Built for real-time apps, infinite customization, and developer happiness*

[Installation](#-installation) • [Features](#-features) • [Documentation](#-quick-start) • [API](#-api-reference) • [Contributing](#-contributing)

</div>

---

## ✨ Features

<table>
<tr>
<td>

🎯 **Zero Configuration**
- Works out of the box
- Auto-discovered migrations
- Sensible defaults

</td>
<td>

⚡ **Lightning Fast**
- Optimized queries
- Minimal overhead
- Ready for real-time

</td>
</tr>
<tr>
<td>

🔧 **Fully Customizable**
- Your models, your rules
- Custom metadata support
- Extensible architecture

</td>
<td>

🛡️ **Enterprise Ready**
- Built-in authentication
- Configurable middleware
- Production tested

</td>
</tr>
</table>

> 💡 **Perfect for**: Chat apps, messaging systems, customer support, team collaboration, and any real-time communication needs.

---

## 🚀 Installation

```bash
# Install the package
composer require faraztanveer/laravel-chat

# Run migrations (auto-discovered)
php artisan migrate
```

**That's it!** 🎉 Your chat system is ready to use.

<details>
<summary>📦 Optional: Publish configuration</summary>

```bash
php artisan vendor:publish --provider="Faraztanveer\LaravelChat\LaravelChatServiceProvider" --tag=laravel-chat-config
```

</details>

---

## ⚙️ Quick Start

### 1️⃣ Setup Your User Model

```php
use Faraztanveer\LaravelChat\Traits\HasChatChannels;

class User extends Authenticatable
{
    use HasChatChannels;
    
    // 🎨 Customize display name (optional)
    public function getChatDisplayName(): string
    {
        return $this->full_name ?? $this->name ?? "{$this->first_name} {$this->last_name}";
    }
    
    // 🏷️ Add custom metadata (optional)
    public function getChatMetadata(): array
    {
        return [
            'avatar' => $this->avatar_url,
            'role' => $this->role,
            'status' => $this->is_online ? 'online' : 'offline',
        ];
    }
}
```

### 2️⃣ Start Chatting

```php
// Create or get a chat channel
$channel = auth()->user()->getOrCreateChannelWith($otherUser);

// Send a message
$message = $channel->sendMessage('Hello there! 👋', auth()->user());

// Get all messages
$messages = $channel->messages()->with('sender')->latest()->get();
```

---

## 🎛️ Configuration

The package works with zero configuration, but you can customize everything:

```php
// config/laravel-chat.php
return [
    // 👤 Your participant model
    'participant_model' => App\Models\User::class,
    
    // 🛣️ API route customization
    'route_prefix' => 'chat',                    // /api/chat/*
    'route_middleware' => ['auth:sanctum'],      // Your auth middleware
    
    // 🏷️ Global participant metadata
    'participant_metadata' => function ($user) {
        return [
            'avatar' => $user->avatar_url,
            'department' => $user->department?->name,
            'timezone' => $user->timezone,
        ];
    },
];
```

<details>
<summary>🔧 Advanced Configuration Examples</summary>

**Custom API prefix and middleware:**
```php
'route_prefix' => 'messaging',
'route_middleware' => ['auth', 'verified', 'throttle:60,1'],
```

**Multi-guard authentication:**
```php
'route_middleware' => ['auth:web,api'],
```

</details>

---

## 📡 API Reference

All endpoints are available under `/api/{route_prefix}` (default: `/api/chat`)

### 🔐 Authentication
All endpoints require Bearer token authentication by default.

```http
Authorization: Bearer YOUR_TOKEN_HERE
```

### 📋 Endpoints Overview

| Method | Endpoint | Description | Body/Params |
|--------|----------|-------------|-------------|
| `POST` | `/channel` | Create or get channel | `{"participant_id": 2}` |
| `GET` | `/channels` | List user's channels | - |
| `GET` | `/channel` | Get channel details | `?channel_id=1` |
| `POST` | `/message` | Send message | `{"channel_id": 1, "body": "Hello!"}` |
| `GET` | `/messages` | Get channel messages | `?channel_id=1` |

### 💬 Create/Get Channel

```http
POST /api/chat/channel
Content-Type: application/json

{
    "participant_id": 2
}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "participants": [
            {
                "id": 1,
                "name": "John Doe",
                "avatar": "https://...",
                "role": "admin"
            },
            {
                "id": 2,
                "name": "Jane Smith",
                "avatar": "https://...",
                "role": "user"
            }
        ],
        "created_at": "2024-01-15T10:30:00Z"
    }
}
```

### 📨 Send Message

```http
POST /api/chat/message
Content-Type: application/json

{
    "channel_id": 1,
    "body": "Hello! How are you today? 😊"
}
```

### 📜 Get Messages

```http
GET /api/chat/messages?channel_id=1&page=1&per_page=20
```

---

## 🧪 Testing Your Integration

### Quick Test with Tinker

```php
// Create test users and tokens
$user1 = \App\Models\User::find(1);
$user2 = \App\Models\User::find(2);

$token = $user1->createToken('chat-test')->plainTextToken;
echo "Bearer Token: " . $token;

// Test in your API client (Postman, Insomnia, etc.)
```

### Example Test Requests

<details>
<summary>🔍 Click to see cURL examples</summary>

```bash
# Create channel
curl -X POST http://your-app.test/api/chat/channel \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"participant_id": 2}'

# Send message
curl -X POST http://your-app.test/api/chat/message \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"channel_id": 1, "body": "Hello World!"}'
```

</details>

---

## 🎨 Customization Examples

### Custom Display Names

```php
public function getChatDisplayName(): string
{
    return match(true) {
        !empty($this->display_name) => $this->display_name,
        !empty($this->full_name) => $this->full_name,
        !empty($this->first_name) && !empty($this->last_name) => "{$this->first_name} {$this->last_name}",
        default => $this->name ?? $this->email ?? 'Anonymous User'
    };
}
```

### Rich Metadata

```php
public function getChatMetadata(): array
{
    return [
        'avatar' => $this->getFirstMediaUrl('avatar') ?: $this->gravatar_url,
        'title' => $this->job_title,
        'department' => $this->department?->name,
        'status' => $this->status,
        'last_seen' => $this->last_active_at?->diffForHumans(),
        'timezone' => $this->timezone ?? 'UTC',
        'preferences' => [
            'notifications' => $this->notifications_enabled,
            'theme' => $this->preferred_theme ?? 'light',
        ],
    ];
}
```

---

## 🚀 Extending the Package

### Adding File Attachments

```php
// In your controller
public function sendMessageWithAttachment(Request $request)
{
    $channel = ChatChannel::find($request->channel_id);
    
    $message = $channel->sendMessage($request->body, auth()->user(), [
        'attachments' => $request->file('attachments'),
        'message_type' => 'file'
    ]);
    
    return response()->json($message);
}
```

### Real-time Broadcasting

```php
// In your Message model
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Message extends Model implements ShouldBroadcast
{
    use InteractsWithSockets;
    
    public function broadcastOn()
    {
        return new PrivateChannel("chat.{$this->channel_id}");
    }
}
```

---

## 🤝 Contributing

We love contributions! Here's how you can help:

- 🐛 **Found a bug?** [Open an issue](https://github.com/faraztanveer/laravel-chat/issues)
- 💡 **Have an idea?** [Start a discussion](https://github.com/faraztanveer/laravel-chat/discussions)
- 🔧 **Want to contribute code?** Check our [contributing guide](CONTRIBUTING.md)

### Development Setup

```bash
git clone https://github.com/faraztanveer/laravel-chat.git
cd laravel-chat
composer install
composer test
```

---

## 🛡️ Security

If you discover any security-related issues, please email security@faraztanveer.com instead of using the issue tracker.

See [SECURITY.md](SECURITY.md) for more details.

---

## 📜 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

## 👨‍💻 Credits

- **[Faraz Tanveer](https://github.com/faraztanveer)** - Creator & Maintainer
- **[All Contributors](../../contributors)** - Thank you! 🙏

---

<div align="center">

**Built with ❤️ for the Laravel community**

⭐ **Star this repo if it helped you!**

[Report Bug](https://github.com/faraztanveer/laravel-chat/issues) • [Request Feature](https://github.com/faraztanveer/laravel-chat/issues) • [Twitter](https://twitter.com/faraztanveer)

</div>
