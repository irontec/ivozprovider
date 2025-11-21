import { Box, styled } from '@mui/material';

export const StyledTemplateAction = styled('span')(() => {
  return {
    cursor: 'pointer',
    paddingRight: '10px',
    '& svg': {
      verticalAlign: 'top',
    },
  };
});

export const StyledTextAreaContainer = styled(Box)(() => {
  return {
    width: '450px',
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'flex-start',
    gap: '20px',
  };
});

export const StyledTextArea = styled('textarea')(() => {
  return {
    width: '100%',
    height: '250px',
    boxSizing: 'border-box',
  };
});

export const StyledMacInputContainer = styled(Box)(() => {
  return {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    gap: '10px',
  };
});

export const StyledErrorContainer = styled(Box)(() => {
  return {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    gap: '5px',
  };
});
