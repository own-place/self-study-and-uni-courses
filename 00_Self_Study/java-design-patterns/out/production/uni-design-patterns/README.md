# Project Overview

This project implements a Java console program designed as a supermarket management system. The main functionality includes inventory management and product sales.

## File Structure

![image info](./file-structure.png)

# Part 1: Inventory Management

This functionality manages product creation and inventory updates, using the following design patterns:

## Applied Design Patterns

### Factory Method (Creational)
The Factory Method pattern is used to encapsulate the creation logic for different types of products (e.g., fruits, vegetables, beverages). This promotes code reusability and flexibility, as new product types can be added without altering existing code. By relying on a factory, the system maintains a single responsibility for product creation, adhering to the Open/Closed Principle.

### Decorator (Structural)
The Decorator pattern allows dynamic addition of features to products, such as marking them as imported or discounted. This eliminates the need for rigid class hierarchies to represent combinations of features, providing greater flexibility and scalability.

### Observer (Behavioral)
The Observer pattern facilitates the notification mechanism when inventory changes occur, such as when new products are added. This ensures separation of concerns, as inventory management and notification logic are decoupled, making the system easier to maintain and extend.

Implementation Steps

Product and Factory (Creation)

File 1: src/main/java/product/Product.javaDefines the abstract product class.

File 2: src/main/java/product/Fruit.javaImplements a concrete product class (Fruit).

File 3: src/main/java/product/ProductFactory.javaDefines the abstract factory class.

File 4: src/main/java/product/FruitFactory.javaImplements a concrete factory for creating fruits.

Decorator (Dynamic Features)

File 5: src/main/java/product/ProductDecorator.javaDefines the abstract product decorator.

File 6: src/main/java/product/ImportedProduct.javaImplements a decorator for imported products.

File 7: src/main/java/product/DiscountedProduct.javaImplements a decorator for discounted products.

Observer (Inventory Notifications)

File 8: src/main/java/observer/Observer.javaDefines the observer interface.

File 9: src/main/java/observer/Admin.javaImplements the administrator observer.

File 10: src/main/java/inventory/Inventory.javaImplements the inventory management system.

Main Program Entry

File 11: src/main/java/Main.javaIntegrates all components to demonstrate inventory functionality.

Part 2: Product Sales and Shipping

This functionality enables product sales and logistics management, using the following design patterns:

Applied Design Patterns

Prototype (Creational)The Prototype pattern is used to clone existing product instances to quickly generate multiple identical products. This is particularly useful in scenarios where the cost of creating a product from scratch is high or where identical instances need to share the same base configuration.

Facade (Structural)The Facade pattern simplifies the complex process of product sales by providing a unified interface to manage order creation, invoice generation, and logistics. This abstraction hides the intricacies of the underlying subsystems, making the system easier to use and reducing dependencies between components.

Command (Behavioral)The Command pattern encapsulates the logic for selling products into individual command objects. This allows for batch processing, undo functionality, and flexible execution of commands. It also promotes separation of concerns by decoupling the client code from the logic of the operations.

Implementation Steps

Prototype (Cloning Products)

File 1: src/main/java/product/ProductPrototype.javaDefines the prototype interface.

File 2: src/main/java/product/ConcreteProduct.javaImplements the product cloning functionality.

Facade (Simplified Sales Process)

File 3: src/main/java/facade/SaleFacade.javaEncapsulates the main steps of the sales process, such as order creation, printing the invoice, and arranging logistics.

Command (Encapsulating Operations)

File 4: src/main/java/command/Command.javaDefines a unified interface for commands.

File 5: src/main/java/command/SellProductCommand.javaImplements the command for selling products.

File 6: src/main/java/command/CommandExecutor.javaManages and executes multiple commands for batch sales.

Main Program Testing

File 7: src/main/java/Main.javaTests the complete sales process, including product cloning, command creation, and batch execution.

Conclusion

This project demonstrates the practical application of multiple design patterns in a Java console program. By leveraging the Factory Method, Decorator, Observer, Prototype, Facade, and Command patterns, the system achieves modularity, scalability, and maintainability. These patterns not only simplify the codebase but also ensure better design practices for real-world applications.

