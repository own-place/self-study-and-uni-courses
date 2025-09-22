import { test, expect } from '@playwright/test';

test.describe('System Test: Login Functionality', () => {
  test('should display error for invalid email and allow login with valid input', async ({ page }) => {
    await page.goto('/login'); // Relative to baseURL

    // Fill in invalid credentials
    await page.fill('input[name="username"]', 'testuser');
    await page.fill('input[name="email"]', 'invalid-email');
    await page.click('button[type="submit"]');

    // Validate error message
    const errorMessage = await page.textContent('.error-message');
    expect(errorMessage).toBe('Please enter a valid email address!');

    // Fill in valid credentials
    await page.fill('input[name="email"]', 'testuser@example.com');
    await page.click('button[type="submit"]');

    // Confirm successful login
    await expect(page).toHaveURL('/dashboard'); // Relative to baseURL
  });
});
