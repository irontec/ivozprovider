import { useDrawingArea } from '@mui/x-charts/hooks';
import { PointerEvent, useState } from 'react';

import { colors } from './chartConfig';
import { ChannelUsagePoint } from './types';

interface ChartPointerLayerProps {
  points: Array<ChannelUsagePoint>;
  onRangeSelected: (from: Date, to: Date) => void;
  hoverIndex?: number | null;
  onHoverIndex?: (index: number | null) => void;
}

const MIN_DRAG_PX = 8;

export default function ChartPointerLayer(
  props: ChartPointerLayerProps
): JSX.Element | null {
  const { points, onRangeSelected, hoverIndex, onHoverIndex } = props;
  const { left, top, width, height } = useDrawingArea();
  const [dragStart, setDragStart] = useState<number | null>(null);
  const [dragCurrent, setDragCurrent] = useState<number | null>(null);

  if (points.length < 2) {
    return null;
  }

  const localX = (event: PointerEvent<SVGRectElement>): number => {
    const bounds = event.currentTarget.getBoundingClientRect();

    return Math.min(Math.max(event.clientX - bounds.left, 0), width);
  };

  const toIndex = (x: number): number =>
    Math.min(Math.floor((x / width) * points.length), points.length - 1);

  const endDrag = () => {
    setDragStart(null);
    setDragCurrent(null);
  };

  const onPointerUp = (event: PointerEvent<SVGRectElement>) => {
    if (dragStart === null) {
      return;
    }

    const x = localX(event);
    const fromIndex = toIndex(Math.min(dragStart, x));
    const toIndexValue = toIndex(Math.max(dragStart, x));
    const isRealDrag = Math.abs(x - dragStart) >= MIN_DRAG_PX;
    const spansSeveralBuckets = toIndexValue > fromIndex;
    endDrag();

    if (!isRealDrag || !spansSeveralBuckets) {
      return;
    }

    onRangeSelected(
      points[fromIndex].timestamp,
      points[toIndexValue].timestamp
    );
  };

  const selection =
    dragStart !== null && dragCurrent !== null
      ? {
          x: left + Math.min(dragStart, dragCurrent),
          width: Math.abs(dragCurrent - dragStart),
        }
      : null;

  const isValidHoverIndex =
    hoverIndex !== null &&
    hoverIndex !== undefined &&
    hoverIndex < points.length;
  const hovered = isValidHoverIndex ? hoverIndex : null;
  const crosshairX =
    hovered === null ? null : left + ((hovered + 0.5) / points.length) * width;

  return (
    <g>
      {crosshairX !== null && (
        <line
          x1={crosshairX}
          x2={crosshairX}
          y1={top}
          y2={top + height}
          stroke={colors.limitLine}
          strokeWidth={1}
          pointerEvents='none'
        />
      )}
      {selection && (
        <rect
          x={selection.x}
          y={top}
          width={selection.width}
          height={height}
          fill={colors.peak}
          fillOpacity={0.15}
          pointerEvents='none'
        />
      )}
      <rect
        x={left}
        y={top}
        width={width}
        height={height}
        fill='transparent'
        cursor='crosshair'
        onPointerDown={(event) => {
          event.currentTarget.setPointerCapture(event.pointerId);
          const x = localX(event);
          setDragStart(x);
          setDragCurrent(x);
        }}
        onPointerMove={(event) => {
          const x = localX(event);
          if (dragStart !== null) {
            setDragCurrent(x);
          }
          onHoverIndex?.(toIndex(x));
        }}
        onPointerUp={onPointerUp}
        onPointerLeave={() => {
          if (dragStart === null) {
            onHoverIndex?.(null);
          }
        }}
      />
    </g>
  );
}
