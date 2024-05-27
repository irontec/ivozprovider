import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const edit = props.edit || false;
  const { entityService, row, match } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);
  const isInterVpbx = formik.values.directConnectivity === 'intervpbx';
  const interVpbxEdition = edit && isInterVpbx;
  const readOnlyProperties = {
    directConnectivity: interVpbxEdition,
    name: interVpbxEdition,
    interCompany: true,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        'password',
        'priority',
        'interCompany',
        'transport',
        'ip',
        'port',
        'ruriDomain',
        'description',
      ],
    },
    edit &&
      !interVpbxEdition && {
        legend: _('Geographic Configuration'),
        fields: ['language', 'transformationRuleSet'],
      },
    edit &&
      !interVpbxEdition && {
        legend: _('Outgoing Configuration'),
        fields: ['callAcl', 'outgoingDdi'],
      },
    !interVpbxEdition && {
      legend: _('Advanced Configuration'),
      fields: [
        edit && 'fromUser',
        edit && 'fromDomain',
        edit && 'allow',
        edit && 'ddiIn',
        edit && 't38Passthrough',
        edit && 'rtpEncryption',
        'multiContact',
        'alwaysApplyTransformations',
      ],
    },
    {
      legend: '',
      fields: [edit && 'statusIcon'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      formik={formik}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
    />
  );
};

export default Form;
