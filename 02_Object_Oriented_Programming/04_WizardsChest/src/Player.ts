import CanvasItem from './CanvasItem.js';
import CanvasRenderer from './CanvasRenderer.js';
import GameItem from './GameItem.js';

export default class Player extends CanvasItem {
  private imageClosed: HTMLImageElement = CanvasRenderer.loadNewImage('assets/chestClosed.png');

  private imageOpen: HTMLImageElement = CanvasRenderer.loadNewImage('assets/chestOpen.png');

  private chestOpen: boolean = true;

  public constructor(startX: number, maxY: number) {
    super();

    this.image = this.imageOpen;
    this.posX = startX;
    this.posY = maxY - 100;
  }

  public toggleOpen(): void {
    if (this.chestOpen) {
      this.chestOpen = false;
      this.image = this.imageClosed;
    } else {
      this.chestOpen = true;
      this.image = this.imageOpen;
    }
  }

  public getChestOpen(): boolean {
    return this.chestOpen;
  }

  public move(newX: number): void {
    this.posX = newX;
  }

  public isCollidingWithItem(item: GameItem): boolean {
    if ((item.getPosX() + item.getWidth() >= this.getPosX())
    && (item.getPosX() <= this.getPosX() + this.getWidth())
    && (item.getPosY() + item.getHeight() >= this.getPosY())
    && (item.getPosY() <= this.getPosY() + this.getHeight())) {
    return true;
  }
  return false;
  }
}
