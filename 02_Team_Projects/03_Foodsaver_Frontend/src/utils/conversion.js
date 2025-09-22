export function convertToGrams(amount, unit) {
    const conversionRates = {
        grams: 1,
        kilograms: 1000,
        tablespoons: 21.25, // 1 tablespoon is approximately 21.25 grams
        teaspoons: 5.69, // 1 teaspoon is approximately 5.69 grams
        cups: 250, // 1 cup is approximately 250 grams
        pounds: 453.592,
    };

    return amount * (conversionRates[unit] || 1);
}

export function convertToMilliliters(amount, unit) {
    const conversionRates = {
        milliliters: 1,
        liters: 1000,
        kilograms: 1000, // 1 kilogram is approximately 1000 mililiters
        tablespoons: 15, // 1 tablespoon is approximately 15 mililiters 
        teaspoons: 5, // 1 teaspoon is approximately 5 mililiters
        cups: 240, // 1 cup is approximately 240 mililiters 
        ounces: 29.5735, // 1 ounce is approximately 28.35 mililiters
    };

    return amount * (conversionRates[unit] || 1);
}