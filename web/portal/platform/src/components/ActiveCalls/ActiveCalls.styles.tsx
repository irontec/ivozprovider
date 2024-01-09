import { ListContentStyler } from '@irontec/ivoz-ui/components/List/Content/ListContent.styles';
import { styled } from '@mui/material';

export const StyledListContent = styled('div')((props) => {
  const resp = ListContentStyler(props);

  return {
    ...resp,
    '& .input-field': {
      display: 'none',
    },
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
  } as any;
});
