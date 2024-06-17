import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior/Form';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, edit } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const readOnlyProperties = {
    prefix: edit || false,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: ['name', 'prefix'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      fkChoices={fkChoices}
      readOnlyProperties={readOnlyProperties}
      groups={groups}
    />
  );
};

export default Form;
