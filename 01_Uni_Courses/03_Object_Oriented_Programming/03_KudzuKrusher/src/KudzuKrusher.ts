import Game from './Game.js';
import CanvasRenderer from './CanvasRenderer.js';
import Scene from './Scene/Scene.js';
import MouseListener from './MouseListener.js';
import SceneStart from './Scene/SceneStart.js';

export default class KudzuKrusher extends Game {
  private canvas: HTMLCanvasElement;

  private mouseListener: MouseListener;

  private currentScene: Scene;

  public constructor(canvas: HTMLCanvasElement) {
    super();
    this.canvas = canvas;
    this.canvas.width = window.innerWidth;
    this.canvas.height = window.innerHeight;
    this.mouseListener = new MouseListener(this.canvas);

    this.currentScene = new SceneStart(this.canvas.width, this.canvas.height);
  }

  /**
   * Process all input. Called from the GameLoop.
   */
  public processInput(): void {
    this.currentScene.processInput(this.mouseListener);
  }

  /**
   * Update game state. Called from the GameLoop
   *
   * @param elapsed time elapsed from the GameLoop
   * @returns true if the game should continue
   */
  public update(elapsed: number): boolean {
    // check if the there is a new scene or to continue with current scene
    if (this.currentScene.getNextScene() != null) {
      this.currentScene = this.currentScene.getNextScene();
    }

    // update current scene
    this.currentScene.update(elapsed);

    // Return true to continue the game
    return true;
  }

  /**
   * Render all the elements in the screen. Called from GameLoop
   */
  public render(): void {
    // Clear the canvas
    CanvasRenderer.clearCanvas(this.canvas);

    // render current scene
    this.currentScene.render(this.canvas);
  }
}
