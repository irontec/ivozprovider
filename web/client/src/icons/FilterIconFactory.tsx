import Contains from './contains';
import StartsWith from './startsWith';
import EndsWith from './endsWith';
import Equals from './equals';
import NotEquals from './notEquals';
import LowerThan from './lowerThan';
import LowerThanEqual from './lowerThanEqual';
import GreaterThan from './greaterThan';
import GreaterThanEqual from './greaterThanEqual';
import NotInterestedIcon from '@mui/icons-material/NotInterested';
import AssignmentTurnedInIcon from '@mui/icons-material/AssignmentTurnedIn';

interface FilterIconFactoryProps {
    name: string,
    fontSize?: 'small' | 'inherit' | 'large' | 'medium' | undefined,
}
export default function FilterIconFactory(props: FilterIconFactoryProps): JSX.Element {

    const { name, ...rest } = props;

    switch (name) {
        case '':
            return <NotInterestedIcon {...rest} />;
        case 'exists':
            return <AssignmentTurnedInIcon {...rest} />;
        case 'partial':
            return <Contains />;
        case 'start':
            return <StartsWith />;
        case 'end':
            return <EndsWith />;
        case 'in':
        case 'exact':
        case 'eq':
            return <Equals />;
        case 'neq':
            return <NotEquals />;
        case 'lt':
            return <LowerThan />;
        case 'lte':
            return <LowerThanEqual />;
        case 'gt':
            return <GreaterThan />;
        case 'gte':
            return <GreaterThanEqual />;
        default:
            const error = { error: `Icon ${name} was not found` };
            throw error;
    }
}