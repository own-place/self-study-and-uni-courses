import Credit1 from './Credits/Credit1.js';
import LevelFive from './Levels/LevelFive.js';
import LevelOne from './Levels/LevelOne.js';
import LevelFour from './Levels/LevelFour.js';
import LevelThree from './Levels/LevelThree.js';
import LevelTwo from './Levels/LevelTwo.js';
import Scene from './Scenes/Scene.js';
import SceneLose from './Scenes/SceneLose.js';
import SceneStart from './Scenes/SceneStart.js';
import SceneWin from './Scenes/SceneWin.js';
import CanvasRenderer from './helperFile/CanvasRenderer.js';
import Game from './helperFile/Game.js';
import MouseListener from './helperFile/MouseListener.js';
import LevelSix from './Levels/LevelSix.js';

export default class Tetra extends Game{
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
    this.canvas.style.cursor = 'none';
  }

  /**
   *
   */
  public override processInput(): void {
    this.currentScene.processInput(this.mouseListener);
  }

  /**
   *
   * @returns true
   */
  public override update(): boolean {
    if(this.currentScene.getNextScene() !== null) {
      this.currentScene = this.currentScene.getNextScene();
    }
    return true;
  }

  /**
   *
   */
  public override render(): void {
    CanvasRenderer.clearCanvas(this.canvas);
    this.currentScene.render(this.canvas);
  }
}
