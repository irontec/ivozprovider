import { styled } from '@mui/styles';
import { Theme } from '@mui/material/styles';
import InfoIcon from '@mui/icons-material/Info';
import Message from './Message';

export default function InfoMessage(props: any) {

    const { message } = props;
    return (
        <StyledInfoMessage message={message} />
    );
}

const StyledInfoMessage = styled(
    (props: any) => {
        const { className, message } = props;
        return (
            <Message
                className={className}
                message={message}
                Icon={InfoIcon}
            />
        );
    }
)(
    ({ theme }: { theme: Theme }) => {
        return {
            backgroundColor: '#616161',
            color: 'white'
        }
    }
);