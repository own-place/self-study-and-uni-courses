package src.main.java.product;

public abstract class ProductDecorator extends Product {
    protected Product decoratedProduct;

    public ProductDecorator(Product product) {
        super(product.name);
        this.decoratedProduct = product;
    }
}
