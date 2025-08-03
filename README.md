# 🦄 Fantastic Beasts

**Generate memorable, anonymous usernames for your PHP applications**

Ever noticed how Google Docs assigns those delightful "Anonymous Zebra" or "Anonymous Elephant" names to users? Or how Telegram contest winners get creative pseudonyms? Fantastic Beasts brings this same whimsical approach to your PHP projects, creating deterministic yet anonymous usernames that are both fun and functional.

## Why Fantastic Beasts?

In many applications, you need to reference users without exposing their real identities. Traditional approaches often result in forgettable strings like "User123456" or complex UUIDs. Fantastic Beasts solves this by generating human-friendly names that are:

- **Memorable**: "Cosmic Hamster" sticks in your mind better than "user_7d3f8a9b"
- **Deterministic**: The same user ID always generates the same name
- **Anonymous**: No personal information is revealed
- **Scalable**: Support for project-specific seeds ensures uniqueness across different contexts

Think of it as giving each user a consistent superhero name that protects their identity while making your application more engaging.

## Installation

Install via Composer:

```bash
composer require antikirra/fantastic-beasts:^1
```

## Usage

The library provides a simple function that transforms user IDs into whimsical creature names. Here's how it works:

### Basic Usage

Generate a random anonymous name (perfect for one-time visitors):

```php
// Generate a random fantastic beast
echo Antikirra\beast(mt_rand()); // "Dizzy Penguin"
```

### Consistent Names for Registered Users

For registered users, pass their user ID to get a consistent name:

```php
// User with ID 42 will always be the same fantastic beast
echo Antikirra\beast(42); // "Alpine Louse"

// Different users get different names
echo Antikirra\beast(123); // "Specimen Duck"
echo Antikirra\beast(456); // "Oceanic Ray"
```

### Project-Specific Namespaces

When running multiple projects, you might want the same user to have different identities in each context. Use the seed parameter to create project-specific namespaces:

```php
// Same user, different projects, different names
$userId = 123456;

// In your forum application
echo Antikirra\beast($userId, 1001); // "Expanded Glassfish"

// In your chat application  
echo Antikirra\beast($userId, 2002); // "Bright Fly"

// In your game server
echo Antikirra\beast($userId, 4815162342); // "American Peeper"
```

This ensures that even if someone discovers a user's identity in one project, they can't track them across your other applications.

## How It Works

The library uses a deterministic algorithm that combines your user ID with an optional seed value to generate a consistent index into curated lists of adjectives and nouns. Here's what happens under the hood:

1. The function takes your user ID and optional seed
2. It creates a hash using CRC32 algorithm
3. This hash is used to select one adjective and one noun from pre-curated lists
4. The result is a unique combination like "Anxious Elephant" or "Quantum Narwhal"

The lists include hundreds of carefully selected adjectives and animal names, creating over 100,000 possible combinations. This approach ensures that:

- The same input always produces the same output (deterministic)
- The relationship between input and output appears random (pseudo-random)
- The names are appropriate and engaging for users

## Important Limitations

While Fantastic Beasts is great for many use cases, it's important to understand its limitations:

**Name Uniqueness**: The algorithm does not guarantee globally unique names. With a finite pool of adjective-noun combinations, collisions will occur, especially at scale. Think of it like human names - multiple people can be named "John Smith". For applications requiring guaranteed uniqueness, consider appending a discriminator (like "Cosmic Hamster#1234").

**Not Cryptographically Secure**: The CRC32 algorithm used is fast and deterministic but not cryptographically secure. Don't use this for security-critical anonymization where sophisticated attacks might attempt to reverse-engineer user IDs.

**Limited Pool Size**: With approximately 600 adjectives and 450 nouns, there are roughly 270,000 possible combinations. Large applications with millions of users will see repeated names.

## Use Cases

Fantastic Beasts shines in scenarios like:

- **Support Systems**: Give customers memorable temporary identities in support chats
- **Gaming**: Assign fun default names to players who haven't chosen their own
- **Analytics Dashboards**: Display user activity without revealing personal information
- **Educational Platforms**: Let students participate anonymously with consistent identities
- **Beta Testing**: Track feedback from testers without collecting personal data
- **Comment Systems**: Allow anonymous but accountable discussions

## Contributing

Feel free to submit issues and enhancement requests! The adjective and noun lists can always be expanded to increase variety.

## License

MIT License - see LICENSE file for details.

---

*❤️ Because every user deserves to be a fantastic beast!*