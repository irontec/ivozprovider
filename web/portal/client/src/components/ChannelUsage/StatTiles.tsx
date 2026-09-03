import { Paper, Stack, Typography } from '@mui/material';
import { ReactNode } from 'react';

export interface StatTile {
  label: ReactNode;
  value: string;
  accent: string;
}

interface StatTilesProps {
  tiles: Array<StatTile>;
}

export default function StatTiles(props: StatTilesProps): JSX.Element {
  const { tiles } = props;

  return (
    <Stack direction='row' flexWrap='wrap' gap={2} sx={{ marginTop: 2 }}>
      {tiles.map((tile, index) => (
        <Paper
          key={index}
          variant='outlined'
          sx={{
            padding: 2,
            minWidth: 160,
            flex: '1 1 160px',
            borderRadius: 2,
            borderLeft: `4px solid ${tile.accent}`,
          }}
        >
          <Typography variant='body2' color='text.secondary'>
            {tile.label}
          </Typography>
          <Typography variant='h4' sx={{ fontWeight: 600 }}>
            {tile.value}
          </Typography>
        </Paper>
      ))}
    </Stack>
  );
}
