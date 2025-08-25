package src.main.java.command;

import src.main.java.facade.SaleFacade;
import src.main.java.product.Product;

public class SellProductCommand implements Command {
    private Product product;
    private SaleFacade saleFacade;

    public SellProductCommand(Product product) {
        this.product = product;
        this.saleFacade = new SaleFacade();
    }

    @Override
    public void execute() {
        saleFacade.sellProduct(product);
    }
}