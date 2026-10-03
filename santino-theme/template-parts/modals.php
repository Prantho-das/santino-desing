<?php
/**
 * Reusable Component: Global Modals (Enquiry, Demo, Video)
 *
 * @package Santino
 */
?>
<!-- Modal: Drop an Enquiry -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
      <div class="modal-header bg-dark text-white p-4">
        <div>
          <h5 class="modal-title font-heading fw-bold mb-1" id="enquiryModalLabel">Commercial Equipment &amp; Solution Inquiry</h5>
          <p class="small text-white-50 mb-0">Our technical specialists will contact you within 2 business hours.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="globalEnquiryForm" onsubmit="event.preventDefault(); alert('Thank you! Your enquiry has been received. Our team will contact you shortly.'); bootstrap.Modal.getInstance(document.getElementById('enquiryModal')).hide();">
          <div class="mb-3">
            <label class="form-label small fw-bold">Full Name *</label>
            <input type="text" class="form-control rounded-3" required placeholder="e.g. Tanvir Ahmed">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Phone / WhatsApp Number *</label>
            <input type="tel" class="form-control rounded-3" required placeholder="+880 17XX-XXXXXX">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Business / Organization Name</label>
            <input type="text" class="form-control rounded-3" placeholder="e.g. Crimson Cup Gulshan / Corporate Office">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Interested In</label>
            <select class="form-select rounded-3">
              <option value="machines">Commercial Espresso Machines</option>
              <option value="beans">Specialty Roasted Beans Supply</option>
              <option value="academy">Barista Academy Certification</option>
              <option value="office">Office &amp; HoReCa Coffee Setup</option>
              <option value="vip">VIP Coffee Club</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label small fw-bold">Message / Specific Requirement</label>
            <textarea class="form-control rounded-3" rows="3" placeholder="Tell us about your daily cup volume, preferred brand, or location..."></textarea>
          </div>
          <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">Submit Enquiry <i class="bi bi-arrow-right ms-1"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Demo Booking -->
<div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="demoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
      <div class="modal-header bg-warning text-dark p-4">
        <div>
          <h5 class="modal-title font-heading fw-bold mb-1" id="demoModalLabel">Book a Live Showroom Demo</h5>
          <p class="small text-dark text-opacity-75 mb-0">Experience extraction &amp; tasting live at our Gulshan Experience Centre.</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="demoBookingForm" onsubmit="event.preventDefault(); alert('Demo session requested! We will call you to confirm your time slot.'); bootstrap.Modal.getInstance(document.getElementById('demoModal')).hide();">
          <div class="mb-3">
            <label class="form-label small fw-bold">Contact Name *</label>
            <input type="text" class="form-control rounded-3" required placeholder="Your Name">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Mobile Number *</label>
            <input type="tel" class="form-control rounded-3" required placeholder="+880 18XX-XXXXXX">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Preferred Date</label>
            <input type="date" class="form-control rounded-3">
          </div>
          <button type="submit" class="btn btn-warning w-100 rounded-pill py-2 fw-bold text-dark">Confirm Demo Slot <i class="bi bi-calendar-check-fill ms-1"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
