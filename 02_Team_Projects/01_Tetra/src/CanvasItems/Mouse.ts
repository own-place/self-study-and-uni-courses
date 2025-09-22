import CanvasItem from './CanvasItem.js';
import CanvasRenderer from '../helperFile/CanvasRenderer.js';

export default class Mouse extends CanvasItem {
  public constructor() {
    super();
    this.image = CanvasRenderer.loadNewImage('./assets/TriangleMouseicon.png');
  }
}
