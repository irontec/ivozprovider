import { Card, CardActions } from '@mui/material';
import { styled } from '@mui/styles';

export const StyledCardActions = styled(CardActions)(
  () => {
    return {
      'padding': '0 16px',
    };
  }
);

export const StyledCard = styled(Card)(
  () => {
    return {
      'margin': '0 0 10px',
    };
  }
);
