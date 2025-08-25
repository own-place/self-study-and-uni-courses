package src.main.java.product;

public class ConcreteProduct extends Product implements ProductPrototype {
    public ConcreteProduct(String name) {
        super(name);
    }

    @Override
    public void store() {
        System.out.println(name + " has been added to the inventory.");
    }

    @Override
    public ProductPrototype cloneProduct() {
        return new ConcreteProduct(this.name);
    }
}
