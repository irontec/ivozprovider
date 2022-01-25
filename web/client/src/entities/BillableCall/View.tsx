import defaultEntityBehavior, { FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { ViewProps } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';

const View = (props: ViewProps): JSX.Element | null => {

    const groups: Array<FieldsetGroups | false> = [
        {
            legend: _('Basic Information'),
            fields: [
                'startTime',
                'duration',
                'direction',
                'caller',
                'callee',
            ]
        },
        {
            legend: _('Extra Information'),
            fields: [
                'callid',
                'endpointType',
                'endpointId',
                'endpointName',
            ]
        },
    ];

    return (<defaultEntityBehavior.View {...props} groups={groups} />);
}

export default View;