
import { styled } from '@mui/styles';

import CloseIcon from '@mui/icons-material/Close';

export const StyledCloseIcon = styled(CloseIcon)(
    () => {
        return {
            position: 'relative',
        }
    }
);

export const StyledSnackbarContentMessageContainer = styled(
    (props) => {
        const { children, className } = props;
        return (<span className={className}>{children}</span>);
    }
)(
    () => {
        return {
            display: 'flex',
            alignItems: 'center',
        }
    }
);