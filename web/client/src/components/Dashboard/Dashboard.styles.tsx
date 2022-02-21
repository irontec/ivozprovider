import { styled } from '@mui/styles';
import Dashboard from './Dashboard'

const StyledDashboard = styled(
    Dashboard
)(
    () => {
        return {
            '& ul': {
                listStyle: 'none',
            },
            '& ul li': {
                margin: '5px 0',
            },
            '& ul li svg': {
                verticalAlign: 'middle',
                marginRight: '5px',
            }
        }
    }
);

export default StyledDashboard;