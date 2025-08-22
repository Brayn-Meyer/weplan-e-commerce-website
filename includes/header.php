<?php
$pageTitle = "WePlan Travel";

// Handle logout if requested
if (isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to landing page
    header("Location: landingpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <style>
        .header {
            background-color: transparent;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
            transition: all 0.3s ease;
        }
        
        /* Glossy effect when scrolled */
        .header.scrolled {
            background: rgba(255, 255, 255, 0.7);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .header-container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 4rem;
        }
        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(to right, #EC4899, #F43F5E);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #DB2777, #E11D48);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .nav-links {
            display: none;
            gap: 2rem;
        }
        @media (min-width: 768px) {
            .nav-links {
                display: flex;
            }
        }
        .airplane-icon {
            color: white;
            transition: color 0.2s;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .airplane-icon:hover {
            color: #FBCFE8;
        }
        .airplane-icon svg {
            width: 100%;
            height: 100%;
        }
        
        /* Change icon colors when scrolled */
        .header.scrolled .airplane-icon {
            color: #1F2937; /* Dark gray/black color */
        }
        .header.scrolled .airplane-icon:hover {
            color: #EC4899;
        }
        
        /* Auth buttons styling */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .auth-button {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .login-button {
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .login-button:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        /* Change login button when scrolled */
        .header.scrolled .login-button {
            color: #1F2937; /* Black color */
            border: 1px solid rgba(0, 0, 0, 0.1);
            background-color: transparent;
        }
        .header.scrolled .login-button:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: #111827; /* Darker black */
        }
        
        .signup-button {
            background: linear-gradient(to right, #EC4899, #F43F5E);
            color: white;
            border: none;
        }
        
        .signup-button:hover {
            background: linear-gradient(to right, #DB2777, #E11D48);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }
        
        .logout-button {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
        }
        
        .logout-button:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        /* Change logout button when scrolled */
        .header.scrolled .logout-button {
            background: rgba(243, 244, 246, 0.7);
            color: #4B5563;
        }
        .header.scrolled .logout-button:hover {
            background: rgba(229, 231, 235, 0.8);
            color: #111827;
        }
        
        .user-greeting {
            margin-right: 0.5rem;
            color: white;
            font-weight: 500;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        /* Change greeting color when scrolled */
        .header.scrolled .user-greeting {
            color: #4B5563;
            text-shadow: none;
        }
        
        @media (max-width: 640px) {
            .auth-buttons {
                gap: 0.5rem;
            }
            .auth-button {
                padding: 0.4rem 0.8rem;
                font-size: 0.875rem;
            }
            .user-greeting {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="header-inner">
                <div class="logo-container">
                    <div class="logo-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-white">
                            <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                        </svg>
                    </div>
                    <h1 class="logo-text">WePlan</h1>
                </div>
                <nav class="nav-links">
                  <!-- In your header.php, modify the home link -->
<a href="landingpage.php" class="airplane-icon" onclick="sessionStorage.setItem('visited', 'true')">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" width="24" height="24">
        <path d="M381 114.9L186.1 41.8c-16.7-6.2-35.2-5.3-51.1 2.7L89.1 67.4C78 73 77.2 88.5 87.6 95.2l146.9 94.5L136 240 77.8 214.1c-8.7-3.9-18.8-3.7-27.3 .6L18.3 230.8c-9.3 4.7-11.8 16.8-5 24.7l73.1 85.3c6.1 7.1 15 11.2 24.3 11.2H248.4c5 0 9.9-1.2 14.3-3.4L535.6 212.2c46.5-23.3 82.5-63.3 100.8-112C645.9 75 627.2 48 600.2 48H542.8c-20.2 0-40.2 4.8-58.2 14L381 114.9zM0 480c0 17.7 14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32c-17.7 0-32 14.3-32 32z"/>
    </svg>
</a>
                </nav>
                <div class="auth-buttons">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="user-greeting">Hello, <?php echo htmlspecialchars($_SESSION['user']['firstname']); ?></span>
                        <a href="?logout=1" class="auth-button logout-button">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="auth-button login-button">Login</a>
                        <a href="login.php?action=signup" class="auth-button signup-button">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <script>
        // Add scroll effect to header
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('.header');
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });

            // Prevent loader from showing when clicking navigation links
            document.querySelectorAll('a[href="landingpage.php"]').forEach(link => {
                link.addEventListener('click', function() {
                    sessionStorage.setItem('doNotShowLoader', 'true');
                });
            });
        });
    </script>