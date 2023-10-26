# Loculus: Your Personal Digital Storage

**Loculus** is your personal digital storage solution, designed to provide you with a secure and user-friendly space for managing your digital files.

## Key Features

...

## Running Loculus Locally

To run Loculus on your local development environment, follow these general steps:

1. **Get the Loculus Code:**
   - Clone this repository.

2. **Web Server Setup:**
   - Place the Loculus project files in your web server's root directory. The web server could be Apache, Nginx, or any other server you're comfortable with.
   - Ensure your web server is running and properly configured.

3. **PHP Configuration:**
   - In your PHP configuration (usually found in `php.ini`), make the following changes:

     - **post_max_size:** Increase the maximum size of POST data that PHP will accept to handle larger file uploads. A value like `1G` is recommended.
     - **upload_max_filesize:** Set this to a higher value, such as `500M`, to allow for larger file uploads.
     - **File Permissions:** On Unix-based systems, set the correct file permissions. You can use `chmod 755` for directory permissions, which allows read, write, and execute permissions for the owner and read/execute permissions for the group and others. Additionally, `chmod g=u` grants the group the same permissions as the owner.
     - **Extension = gd:** If your web app involves image processing or manipulation, enable the GD extension, which provides functions for image creation and manipulation.

   If you encounter issues with PHP configurations, consult your PHP server's documentation or your hosting provider.

4. **Access Loculus:**
   - Open your web browser and access Loculus at `http://localhost/loculus` (or the appropriate URL depending on your web server setup).

...

## Notes for Different Platforms

### Running Loculus on Arch Linux

If you're running Loculus on Arch Linux, the steps are mostly the same, but you'll need to use the package manager specific to Arch (usually `pacman`) to install the required dependencies such as Apache or Nginx, PHP, and other necessary packages.

### Running Loculus on Other Platforms

For other platforms like Windows or macOS, you might need to set up a local development environment using software like XAMPP, WAMP, MAMP, or other alternatives. The core steps of web server setup and PHP configuration will still apply.

Remember, these are general instructions, and specific setup details might vary depending on your environment. Consult the documentation for your web server and PHP configuration for platform-specific details.

...
