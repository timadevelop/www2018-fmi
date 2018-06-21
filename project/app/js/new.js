function initNewPostForm() {
  const newPostForm = document.getElementById('newTripForm');

  let newTrip = {
    title: null,
  };

  let currentStep = 0;

  let steps = {
    0: [{
      name: "title",
      type: "text"
    }],
    1: [{
      name: "short_description",
      type: "text"
    }]
  };
}
