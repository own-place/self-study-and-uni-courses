package src.main.java;

import src.main.java.inventory.Inventory;
import src.main.java.observer.Admin;
import src.main.java.product.*;
import src.main.java.command.CommandExecutor;
import src.main.java.command.SellProductCommand;
import src.main.java.product.ConcreteProduct;
import src.main.java.product.ProductPrototype;

public class Main {
    public static void main(String[] args) {
        // Create a product factory
        ProductFactory fruitFactory = new FruitFactory();

        // Create a product
        Product apple = fruitFactory.createProduct("Apple");

        // Adding decorators to the product
        Product importedApple = new ImportedProduct(apple);
        Product discountedApple = new DiscountedProduct(importedApple);

        // Create an inventory and add observers
        Inventory inventory = new Inventory();
        inventory.addObserver(new Admin("Admin1"));
        inventory.addObserver(new Admin("Admin2"));

        // Add products to the inventory
        discountedApple.store();
        inventory.addProduct(discountedApple);

        // Create a product prototype
        ProductPrototype productPrototype = new ConcreteProduct("Apple");

        // Copy the product prototype and create two products
        ConcreteProduct product1 = (ConcreteProduct) productPrototype.cloneProduct();
        ConcreteProduct product2 = (ConcreteProduct) productPrototype.cloneProduct();

        // Create a command to sell the products
        SellProductCommand command1 = new SellProductCommand(product1);
        SellProductCommand command2 = new SellProductCommand(product2);

        // Execute the commands
        CommandExecutor executor = new CommandExecutor();
        executor.addCommand(command1);
        executor.addCommand(command2);

        executor.executeCommands();
    }
}

