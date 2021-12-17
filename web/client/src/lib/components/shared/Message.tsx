import { useState } from 'react';
import Snackbar from '@mui/material/Snackbar';
import SnackbarContent from '@mui/material/SnackbarContent';
import IconButton from '@mui/material/IconButton';
import { StyledCloseIcon, StyledSnackbarContentMessageContainer } from './Message.styles';
import { OverridableComponent } from '@mui/material/OverridableComponent';
import { SvgIconTypeMap } from '@mui/material';

export interface MessageProps {
    message: string,
    Icon: OverridableComponent<SvgIconTypeMap<any, "svg">>
}

export default function Message(props: MessageProps): JSX.Element {
    const { message, Icon } = props;
    const [open, setOpen] = useState<boolean>(true);

    const handleClose = (): void => {
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
                message={
                    <StyledSnackbarContentMessageContainer>
                        <Icon />
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
