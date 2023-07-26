import styled from '@emotion/styled';
import { MenuItem } from '@mui/material';

const ContainerStatus = styled('div')(() => {
  return {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    paddingLeft: '10px',
    paddingRight: '10px',
    '& > p': {
      margin: '0',
    },
  };
});

const StyledCompanyName = styled('h4')(() => {
  return {
    width: '100%',
    textAlign: 'center',
    borderBottom: 'solid 3px #dedede',
    margin: '0',
    color: '#558abb',
    fontSize: '20px',
  };
});

const StyledHorizontalLine = styled('p')(() => {
  return {
    width: '100%',
    backgroundColor: '#e5e5e5',
    marginBottom: '10px !important',
  };
});

const StatusMenuItem = styled(MenuItem)(() => {
  return {
    cursor: 'default',
    display: 'flex',
    padding: '0px',
    pointerEvents: 'none',
    opacity: '0.8',
  };
});

const Logo = styled('div')(() => {
  return {
    border: '3px solid #fff',
    width: '120px',
    height: '120px',
    overflow: 'hidden',
    backgroundColor: '#fff',
    backgroundSize: 'contain',
    backgroundRepeat: 'no-repeat',
    backgroundPosition: 'center',
    borderRadius: '50%',
  };
});
export {
  ContainerStatus,
  Logo,
  StatusMenuItem,
  StyledCompanyName,
  StyledHorizontalLine,
};
