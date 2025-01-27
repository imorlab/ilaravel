# Newsletter Module Documentation

## Overview
The Newsletter Module is a dynamic email template editor built with Laravel, Livewire, and Bootstrap. It allows users to create and customize email newsletters with real-time preview capabilities.

## Features
- Dynamic content block editing
- Real-time preview updates
- Template saving and downloading
- Responsive design
- Database persistence

## Technical Stack
- **Backend:** Laravel 10.x
- **Frontend:** 
  - Livewire 3.x
  - Bootstrap 5.x
- **Database:** MySQL

## Installation

1. Ensure you have the required database tables:
```sql
php artisan migrate
```

This will create the `cerberus_templates` table with the following structure:
- `id` (bigint, auto-increment)
- `name` (string)
- `blocks` (json)
- `is_active` (boolean)

## Usage

### Accessing the Editor
Navigate to `/newsletter/editor` to access the newsletter editor interface.

### Content Blocks
The editor supports the following content blocks:

1. **Header Block**
   - Logo URL
   - Alt Text

2. **Hero Block**
   - Image URL
   - Alt Text
   - Image Width (default: 600px)
   - Alignment (left, center, right)

3. **Content Block**
   - Title
   - Text
   - Button Text
   - Button URL

4. **Two Columns Block**
   - Left Column
     - Image URL
     - Text
   - Right Column
     - Image URL
     - Text

5. **Footer Block**
   - Company Name
   - Address
   - Phone

### Editing Content
1. Each block can be toggled on/off using the switch
2. All changes are saved automatically
3. The preview updates in real-time
4. Use the "Download Template" button to export the HTML

## Component Structure

### Main Files
- `app/Livewire/CerberusEditor.php`: Main component logic
- `resources/views/livewire/cerberus-editor.blade.php`: Editor interface
- `resources/views/emails/template.blade.php`: Email template
- `app/Models/CerberusTemplate.php`: Template model

### Data Flow
1. User inputs are captured using `wire:model.live`
2. Changes are automatically synced with the Livewire component
3. Preview updates every 5 seconds using `wire:poll`
4. Templates are saved to the database automatically

## Best Practices

### Content Guidelines
- Use high-quality images with appropriate dimensions
- Keep text content concise and engaging
- Ensure all links are valid and secure (https)
- Test templates across different email clients

### Performance Considerations
- Images should be optimized for email
- Avoid excessive use of large images
- Keep HTML structure clean and simple

## Troubleshooting

### Common Issues

1. **Preview Not Updating**
   - Check browser console for errors
   - Ensure Livewire is properly initialized
   - Verify database connection

2. **Images Not Loading**
   - Verify image URLs are accessible
   - Check image format compatibility
   - Ensure proper URL encoding

3. **Template Not Saving**
   - Check database connection
   - Verify proper permissions
   - Review error logs

## Future Enhancements
- [ ] Add image upload capability
- [ ] Implement template versioning
- [ ] Add more block types
- [ ] Enhanced mobile preview
- [ ] Email client testing integration

## Support
For technical support or feature requests, please create an issue in the project repository or contact the development team.

## License
This module is part of the main application and follows its licensing terms.
