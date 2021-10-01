import { useState } from 'react';
import Snackbar from '@mui/material/Snackbar';
import SnackbarContent from '@mui/material/SnackbarContent';
import IconButton from '@mui/material/IconButton';
import { StyledCloseIcon, StyledSnackbarContentMessageContainer } from './Message.styles';

export default function Message(props: any) {

    const { message, className, icon } = props;
    const [open, setOpen] = useState(true);

    const handleClose = () => {
        setOpen(false);
    }

    return (
        <Snackbar
            anchorOrigin={{
                vertical: 'bottom',
                horizontal: 'right',
            }}
            open={open}
            autoHideDuration={5000}
            onClose={handleClose}
        >
            <SnackbarContent
                className={className}
                message={
                    <StyledSnackbarContentMessageContainer>
                        {icon}
                        {message}
                    </StyledSnackbarContentMessageContainer>
                }
                action={[
                    <IconButton key="close" aria-label="close" color="inherit" onClick={handleClose}>
                        <StyledCloseIcon />
                    </IconButton>,
                ]}
            />
        </Snackbar>
    );
}
