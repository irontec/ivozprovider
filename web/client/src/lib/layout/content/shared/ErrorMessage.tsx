
import { styled } from '@mui/styles';
import { Theme } from '@mui/material/styles';
import ErrorIcon from '@mui/icons-material/Error';
import Message from './Message';

export default function ErrorMessage(props: any) {

    const { message } = props;
    return (
        <StyledErrorMessage message={message} />
    );
}

const StyledErrorMessage = styled(
    (props: any) => {
        const { className, message } = props;
        return (
            <Message
                className={className}
                message={message}
                Icon={ErrorIcon}
            />
        );
    }
)(
    ({ theme }: { theme: Theme }) => {
        return {
            backgroundColor: theme.palette.error.dark,
            color: 'white'
        }
    }
);