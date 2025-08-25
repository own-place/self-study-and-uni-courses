package src.main.java.product;

public class Fruit extends Product {
    public Fruit(String name) {
        super(name);
    }

    @Override
    public void store() {
        System.out.println(name + " has been added to the inventory (Fruit).");
    }
}
