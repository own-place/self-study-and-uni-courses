import Scene from './Scene.js';
import MouseListener from '../MouseListener.js';
import Player from '../Player.js';
import ScoreItem from '../ScoreItems/ScoreItem.js';
import CanvasRenderer from '../CanvasRenderer.js';
import Flower from '../ScoreItems/Flower.js';
import Kudzu from '../ScoreItems/Kudzu.js';
import SceneWin from './SceneWin.js';
import SceneLose from './SceneLose.js';

export default class Level extends Scene {
  private player: Player;

  private scoreItem: ScoreItem[] = [];

  private timeToNextItem: number = 0;

  private currentScore: number = 0;

  private flowerLost: number = 0;

  private isMouseClicked: boolean = false;

  public constructor(maxX: number, maxY: number) {
    super(maxX, maxY);

    this.player = new Player(maxX, maxY);

    // display 100 flowers on the screen when game starts
    for (let i: number = 0; i < 100; i++) {
      this.scoreItem.push(new Flower(maxX, maxY));
    }
  }

  /**
   * Process all input
   * @param mouseListener mouseListener
   */
  public override processInput(mouseListener: MouseListener): void {
    // track the current positions of mouse
    const currentX: number = mouseListener.getMousePosition().x;
    const currentY: number = mouseListener.getMousePosition().y;
    // pass the positions to player
    this.player.move(currentX, currentY);
    // set it to true if the mouse clicked
    this.isMouseClicked = mouseListener.buttonPressed(MouseListener.BUTTON_LEFT);
  }

  /**
   * Update game state
   * @param elapsed time elapsed
   */
  public override update(elapsed: number): void {
    // generate new items
    this.timeToNextItem -= elapsed;
    if (this.timeToNextItem <= 0) {
      if (Math.random() <= 0.6) {
        this.scoreItem.push(new Flower(this.maxX, this.maxY));
      } else if (Math.random() < 1) {
        this.scoreItem.push(new Kudzu(this.maxX, this.maxY));
      }
      this.timeToNextItem = 500;
    }

    // update the status of items
    this.scoreItem.forEach((item: ScoreItem) => item.update(elapsed));

    // check if the player collides with items
    for (let i: number = 0; i < this.scoreItem.length; i++) {
      if (this.isMouseClicked) {
        if (this.player.isCollidingWithItem(this.scoreItem[i])) {
          this.currentScore += this.scoreItem[i].getScore();
          if (this.scoreItem[i] instanceof Flower) {
            this.flowerLost += 1;
          }
          this.scoreItem.splice(i, 1);
        }
      }

      // check if kudzu collides with flowers
      for (let j: number = 0; j < this.scoreItem.length; j++) {
        if (this.scoreItem[j] instanceof Kudzu && this.scoreItem[i] instanceof Flower) {
          if (this.scoreItem[j].isCollidingWithItem(this.scoreItem[i])) {
            this.flowerLost += 1;
            this.scoreItem.splice(i, 1);
          }
        }
      }
    }
  }

  public override getNextScene(): Scene | null {
    if (this.currentScore >= 100) {
      return new SceneWin(this.maxX, this.maxY);
    }
    if (this.currentScore < 0) {
      return new SceneLose(this.maxX, this.maxY);
    }
    return null;
  }

  /**
   * render all the elements in the screen
   * @param canvas canvas element
   */
  public override render(canvas: HTMLCanvasElement): void {
    CanvasRenderer.writeText(canvas, `Score: ${this.currentScore}`, 30, 50, 'left', 'Arial', 35, 'white');
    CanvasRenderer.writeText(canvas, `Flower Lost: ${this.flowerLost}`, 30, 90, 'left', 'Arial', 35, 'white');

    this.player.render(canvas);

    this.scoreItem.forEach((item: ScoreItem) => item.render(canvas));
  }
}
