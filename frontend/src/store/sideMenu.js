export function superadmin(id) {
  return [{
    code: 'account',
    label: 'My Account',
    caption: 'Account details',
    icon: 'fal fa-user-edit',
    route: { name: 'user.edit', params: { id }, query: { my_account: 1 } },
    children: [],
    link: null,
    target: null
  }, {
    code: 'locations',
    label: 'Locations',
    icon: 'fal fa-thumbtack',
    route: { name: 'location.listing' }
  }, {
    code: 'medical_conditions',
    label: 'Medical Conditions',
    icon: 'fal fa-file-medical-alt',
    route: { name: 'medicalCondition.listing' }
  }, {
    code: 'regional_responsibles',
    label: 'Regional Responsibles',
    icon: 'fal fa-globe-europe',
    route: { name: 'user.listing', query: { role: 'responsible' } }
  }, {
    code: 'users',
    label: 'Users',
    caption: 'User accounts',
    icon: 'fal fa-users',
    route: { name: 'user.listing' },
    children: [],
    link: null,
    target: null
  }, {
    code: 'settings',
    label: 'Settings',
    caption: 'System settings',
    icon: 'fal fa-cog',
    route: '/settings',
    children: [],
    link: null,
    target: null
  }]
}

export function user(id) {
  return [{
    code: 'account',
    label: 'My Account',
    caption: 'Account details',
    icon: 'fal fa-user-edit',
    route: { name: 'user.edit', params: { id }, query: { my_account: 1 } },
    children: [],
    link: null,
    target: null
  }, {
    code: 'settings',
    label: 'Settings',
    caption: 'System settings',
    icon: 'fal fa-cog',
    route: '/settings',
    routeParams: {},
    children: [],
    link: null,
    target: null
  }]
}

export function responsible(id) {
  return [{
    code: 'account',
    label: 'My Account',
    caption: 'Account details',
    icon: 'fal fa-user-edit',
    route: { name: 'user.edit', params: { id }, query: { my_account: 1 } },
    children: [],
    link: null,
    target: null
  }, {
    code: 'intervention_nurses',
    label: 'Intervention Nurses',
    icon: 'fal fa-user-nurse',
    route: { name: 'user.listing', query: { role: 'nurse' } }
  }, {
    code: 'data_collectors',
    label: 'Data Collectors',
    icon: 'fal fa-user-chart',
    route: { name: 'user.listing', query: { role: 'collector' } }
  }, {
    code: 'settings',
    label: 'Settings',
    caption: 'System settings',
    icon: 'fal fa-cog',
    route: '/settings',
    routeParams: {},
    children: [],
    link: null,
    target: null
  }]
}
