package src.main.java.product;

public class DiscountedProduct extends ProductDecorator {
    public DiscountedProduct(Product product) {
        super(product);
    }

    @Override
    public void store() {
        decoratedProduct.store();
        System.out.println(name + " is on sale.");
    }
}
