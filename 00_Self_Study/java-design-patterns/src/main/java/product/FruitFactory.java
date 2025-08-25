package src.main.java.product;

public class FruitFactory extends ProductFactory {
    @Override
    public Product createProduct(String name) {
        return new Fruit(name);
    }
}
