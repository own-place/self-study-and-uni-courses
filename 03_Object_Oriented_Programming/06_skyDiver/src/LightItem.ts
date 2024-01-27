import CanvasItem from './CanvasItem.js';

export default abstract class LightItem extends CanvasItem {
  protected lightForce: number;

  protected speed: number;

  /**
   * get the lightForce
   * @returns the lightForce
   */
  public getLightForce(): number {
    return this.lightForce;
  }
}
