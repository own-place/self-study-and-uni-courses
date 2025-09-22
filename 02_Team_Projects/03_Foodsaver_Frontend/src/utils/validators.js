// utils/validators.js
export function validateEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }
  