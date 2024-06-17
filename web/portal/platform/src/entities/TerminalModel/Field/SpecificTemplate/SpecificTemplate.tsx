import { ScalarProperty } from '@irontec-voip/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec-voip/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { TerminalModelPropertyList } from '../../TerminalModelProperties';
import Restore from './Restore';
import RunTemplate from './RunTemplate';

type TerminalModelValues = TerminalModelPropertyList<string>;

export type PropsType =
  PropertyCustomFunctionComponentProps<TerminalModelValues>;

export type SpecificTemplateType = PropertyCustomFunctionComponent<PropsType>;

const SpecificTemplate: SpecificTemplateType = (props): JSX.Element => {
  const { values, formFieldFactory, _context, _columnName, property } = props;
  const { specificUrlPattern } = values as TerminalModelValues;

  if (_context === 'read' || !formFieldFactory) {
    return <span>{specificUrlPattern}</span>;
  }

  const modifiedProperty = { ...property } as ScalarProperty;
  delete modifiedProperty.component;

  const { choices, readOnly } = props;

  return (
    <>
      {formFieldFactory.getInputField(
        _columnName,
        modifiedProperty,
        choices,
        readOnly
      )}
      <Restore {...props} />
      <RunTemplate {...props} />
    </>
  );
};

export default SpecificTemplate;
