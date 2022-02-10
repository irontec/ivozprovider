import DownloadingIcon from '@mui/icons-material/Downloading';
import { PropertyCustomFunctionComponent, PropertyCustomFunctionComponentProps, CustomFunctionComponentContext } from 'lib/services/form/Field/CustomComponentWrapper';
import { RatingProfilePropertyList } from '../RatingProfileProperties';

type RatingProfileValues = RatingProfilePropertyList<string | number>;
type DownloadType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<RatingProfileValues>>;

const Download: DownloadType = (props): JSX.Element => {
    //@TODO
    return (
        <DownloadingIcon />
    );
}

export default Download;