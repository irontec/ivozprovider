import withCustomComponentWrapper, {
  CustomFunctionComponentContext,
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { ExternalCallFilterPropertyList } from '../ExternalCallFilterProperties';

type ExternalCallFilterValues = ExternalCallFilterPropertyList<boolean>;

type UnconditionalListColumnProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ExternalCallFilterValues>
>;

const UnconditionalListColumn: UnconditionalListColumnProps = (
  props
): JSX.Element | null => {
  const { _context, values } = props;

  if (_context === CustomFunctionComponentContext.read) {
    const hasNumber = values?.outOfScheduleNumberValue?.toString().length > 0;

    return <span>{hasNumber ? _('Yes') : _('No')}</span>;
  }

  return null;
};

export default withCustomComponentWrapper<ExternalCallFilterValues>(
  UnconditionalListColumn
);
