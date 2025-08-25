import ScoreItem from './ScoreItem.js';
import CanvasRenderer from './CanvasRenderer.js';

export default class Spider extends ScoreItem {
  public constructor(maxX: number) {
    super();

    if (Math.random() <= 0.1) {
      this.image = CanvasRenderer.loadNewImage('assets/spider01.png');
      this.score = -5;
    } else if (Math.random() <= 0.3) {
      this.image = CanvasRenderer.loadNewImage('assets/spider02.png');
      this.score = -3;
    } else if (Math.random() <= 0.6) {
      this.image = CanvasRenderer.loadNewImage('assets/spider03.png');
      this.score = -2;
    } else if (Math.random() < 1) {
      this.image = CanvasRenderer.loadNewImage('assets/spider04.png');
      this.score = -1;
    }

    this.posX = maxX * Math.random();
    this.posY = 10;
  }

  public override update(elapsed: number): void {
    this.posY += this.speed * elapsed;
  }
}
