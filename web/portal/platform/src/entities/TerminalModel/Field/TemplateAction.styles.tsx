import { styled } from '@mui/material';

const StyledTemplateAction = styled('span')(() => {
  return {
    cursor: 'pointer',
    paddingRight: '10px',
    '& svg': {
      verticalAlign: 'top',
    },
  };
});

export default StyledTemplateAction;
