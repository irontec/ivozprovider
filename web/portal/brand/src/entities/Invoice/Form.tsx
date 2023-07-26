import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const edit = props.edit || false;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: [
        !edit && 'numberSequence',
        !row?.numberSequence && 'number',
        'company',
        'invoiceTemplate',
      ],
    },
    {
      legend: '',
      fields: ['inDate', 'outDate'],
    },
    {
      legend: '',
      fields: [edit && 'total', 'taxRate', edit && 'totalWithTax'],
    },
    edit && {
      legend: '',
      fields: ['status', 'pdf'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
