import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import DownloadingIcon from '@mui/icons-material/Downloading';
import { RatingProfilePropertyList } from '../RatingProfileProperties';

type RatingProfileValues = RatingProfilePropertyList<string | number>;
type DownloadType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<RatingProfileValues>
>;

const Download: DownloadType = (): JSX.Element => {
  //@TODO
  return <DownloadingIcon />;
};

export default Download;
