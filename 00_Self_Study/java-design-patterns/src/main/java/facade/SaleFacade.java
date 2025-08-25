package src.main.java.facade;

import src.main.java.product.Product;

public class SaleFacade {
    public void sellProduct(Product product) {
        System.out.println("Selling product: " + product.getName());
        generateInvoice(product);
        arrangeShipping(product);
    }

    private void generateInvoice(Product product) {
        System.out.println("Generating invoice: Product " + product.getName() + " is sold.");
    }

    private void arrangeShipping(Product product) {
        System.out.println("Arranging shipping: Product " + product.getName() + " is shipped.");
    }
}
