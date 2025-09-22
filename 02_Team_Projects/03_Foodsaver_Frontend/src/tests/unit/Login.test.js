import { validateEmail } from '../../utils/validators';

describe('Email validation', () => {
  test('returns true for valid email', () => {
    expect(validateEmail('testuser@example.com')).toBe(true);
  });

  test('returns false for invalid email', () => {
    expect(validateEmail('invalid-email')).toBe(false);
  });

  test('returns false for empty email', () => {
    expect(validateEmail('')).toBe(false);
  });
});
