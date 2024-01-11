import Game from './Game.js';
import CanvasRenderer from './CanvasRenderer.js';
import KeyListener from './KeyListener.js';
import Level from './Level.js';
import Level1 from './Level1.js';
import Level2 from './Level2.js';

export default class WizardsChest extends Game {
  private canvas: HTMLCanvasElement;

  private keyListener: KeyListener;

  private currentLevel: Level;

  public constructor(canvas: HTMLCanvasElement) {
    super();
    this.canvas = canvas;
    this.canvas.height = window.innerHeight;
    this.canvas.width = 600;
    this.keyListener = new KeyListener();
    this.currentLevel = new Level1(this.canvas.width, this.canvas.height);
    this.currentLevel.startLevel();
  }

  public processInput(): void {
    this.currentLevel.processInput(this.keyListener);
  }

  public update(elapsed: number): boolean {
    // update game state
    this.currentLevel.update(elapsed);
    // check if there is a new level to load
    if (this.currentLevel.nextLevel() != null) {
      this.currentLevel = this.currentLevel.nextLevel();
      this.currentLevel.startLevel();
    }
    // returns true if the game should continue
    return true;
  }

  public render(): void {
    CanvasRenderer.clearCanvas(this.canvas);

    this.currentLevel.render(this.canvas);
  }
}
