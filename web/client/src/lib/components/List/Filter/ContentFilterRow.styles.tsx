import { styled } from '@mui/styles';
import ContentFilterRow from './ContentFilterRow';


export const StyledContentFilterRow = styled(ContentFilterRow)(
    () => {
        return {
            '& .icon': {
                display: 'inline-flex',
                marginRight: '10px',
            },
            '& clickableIcon': {
                display: 'inline-flex',
                marginRight: '10px',
                cursor: 'pointer',
            },
            '& grid': {
                margin: '0',
            }
        }
    }
);
